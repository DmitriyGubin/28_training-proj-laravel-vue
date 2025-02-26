<script>

    import axios from 'axios';

    export default {
        data() {
            return {
                posts: null,
                cats: null,
                cur_post_name: null,
                cur_post_descr: null,
                selected_cat: null
            }
        },

        methods: {
            Get_Posts: function() {
                axios.post('/post_api/').then(res => {
                    this.posts = res.data;
                    for(let item of this.posts)
                    {
                        item.save = false;
                        item.error = false;
                    }
                    //console.log(this.posts);
                })
            },
            Get_Cats: function() {
                axios.post('/cat_api/').then(res => {this.cats = res.data})
            },
            Remove_Item: function(id) {
                this.posts = this.posts.filter(post => {
                    return post.id !== id;
                });
            },
            Add_Item: function(e){
                e.preventDefault();
                let err = Validate($('#add_post_form'));
                if(err == 0 && this.selected_cat != null)
                {
                    let post = {
                        id: this.posts[this.posts.length - 1].id + 1,
                        name: this.cur_post_name,
                        sort_order: '1',
                        text: '',
                        desc: this.cur_post_descr,
                        cats_id: this.selected_cat,
                        prop_one: '1',
                        prop_two: '1'
                    };

                    console.log(post);
                    this.posts.push(post);

                    $('.error_text.add').html('Пост успешно добавлен').removeClass('hide');
                    setTimeout(function() {
                        $('.error_text.add').addClass('hide');
                        $('#add_post_form')[0].reset();
                    }, 1000);
                }
                else
                {
                    $('.error_text.add').html('Заполните все поля').removeClass('hide');
                }
            },
            Show_Save_Button: function(post){
                post.save = true;
            },
            Save_Item: function(post){
                if((post.name != '') && (post.desc != ''))
                {
                    post.error = false;
                    post.save = false;
                    console.log(post);
                }
                else
                {
                    post.error = true;
                }
            }
        },

        beforeMount() {
            this.Get_Posts();
            this.Get_Cats();
        }
    }

    function Validate($form_ref)//интересно как отработает
    {
        var err= 0;
        
        $form_ref.find('.required').each(function() {

            var $this = $(this);
            var inp_val = $this.val();

            var bool = (inp_val == '');
            
            if (bool)
            {
                err++;
                $this.addClass("error");
            } 
            else 
            {
                $this.removeClass("error");
            }
        });

        return err;
    }
</script>

<template>

    <form id="add_post_form">
        <h2>Добавить пост</h2>
        <input class="required" type="text" placeholder="Название поста" v-model="cur_post_name">
        <textarea class="required" placeholder="Описание поста" v-model="cur_post_descr"></textarea>

        <div>Категория</div>
        <select v-model="selected_cat">
            <option :value="elem.id" v-for="elem in cats">{{ elem.name }}</option>
        </select>

        <button @click="Add_Item">Добавить пост</button>
        <div class="error_text add hide">
            Заполните все поля
        </div>
    </form>

    <div class="post_item" v-for="elem in posts" :key="elem.id">
        <div class="post_wrap">
            <div>Пост {{ elem.id }}</div>
            <input :class="{error: (elem.name == '')}" @input="Show_Save_Button(elem)" type="text" name="name" placeholder="Название" v-model="elem.name">
            <textarea :class="{error: (elem.desc == '')}" @input="Show_Save_Button(elem)" name="descr" placeholder="Описание поста" v-model="elem.desc"></textarea>
            <button @click="Save_Item(elem)" v-show="elem.save" class="save_button">Сохранить</button>
            <button class="delete_button" @click="Remove_Item(elem.id)">Удалить</button>
            <div v-show="elem.error" class="error_text">Заполните все поля</div>
        </div>
    </div>

    <div>{{ posts }}</div>
</template>

<style>
    input:focus,
    textarea:focus
    {
        outline: none;
    }
</style>