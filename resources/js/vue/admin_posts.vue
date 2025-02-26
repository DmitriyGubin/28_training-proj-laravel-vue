<script>

    import axios from 'axios';
    import post from './one_post.vue';
    import Form from './form.vue';
    import Form_Cat from './form_cat.vue';
    import Pager from './pagination.vue';
    import Delete_Cat_Form from './delete_cat.vue';

    export default {
        data() {
            return {
                posts: null,
                cats: null,
                pages_count: null,
                pages: new Array(),
                cur_page: 1,
                per_page: null,
                total_posts: null
            }
        },

        methods: {
            Get_Posts: function(page) {
                axios.get('/post_api',{params: { page: page }}).then(res => {
                    this.posts = res.data.data;
                    console.log(res.data);
                    this.pages_count = res.data.last_page;
                    this.per_page = res.data.per_page;
                    this.total_posts = res.data.total;
                    for(let item of this.posts)
                    {
                        item.save = false;
                        item.error = false;
                    }
                    //console.log(this.posts);
                    this.Make_Pages(page);
                })
            },

            Make_Pages: function(cur_page){
                this.pages = [];
                for (let i = 1; i <= this.pages_count; i++)
                    {
                        let active = false;
                        if(i == cur_page)
                        {
                            active = true; 
                        }
                        this.pages.push({
                            num: i,
                            active: active
                        });
                    }
                this.cur_page = cur_page;
            },

            Get_Cats: function() {
                axios.post('/cat_api').then(res => {this.cats = res.data})
            },

            Remove_Item: function(id) {
                let post_data = { id_post: id };
                axios.post('/delete_post', post_data).then(res => {
                    console.log(res.data);
                    this.total_posts--;
                    this.Change_Pages_View();
                    this.posts = this.posts.filter(post => {
                        return post.id !== id;
                    });
                });
            },

            Remove_Cat: function(id) {
                let post_data = { 'id_cat': id };
                axios.post('/delete_cat', post_data).then(res => {
                    console.log(res.data);
                    this.cats = this.cats.filter(cat => {
                        return cat.id !== id;
                    });
                });
            },

            Change_Pages_View: function(){
                let new_pages_count = Math.ceil(this.total_posts/this.per_page);
                if(new_pages_count != this.pages_count)
                {
                    this.pages_count = new_pages_count;
                    this.Make_Pages(this.cur_page);
                }
            },

            Add_Item: function(post_name, post_descr, cat_id){
                
                let err = Validate($('#add_post_form'));
                if(err == 0 && cat_id != null)
                {
                    let post = {
                        name: post_name,
                        sort_order: '1',
                        text: '1',
                        desc: post_descr,
                        cats_id: cat_id,
                        prop_one: '1',
                        prop_two: '1'
                    };

                    axios.post('/add_post', post).then(res => {
                        post.id = res.data.id;
                        //this.posts.push(post);
                        this.posts.unshift(post);
                        this.total_posts++;
                        this.Change_Pages_View();

                        $('.error_text.add').html('Пост успешно добавлен').removeClass('hide');
                        setTimeout(function() {
                            $('.error_text.add').addClass('hide');
                            $('#add_post_form')[0].reset();
                        }, 1000);
                    });
                }
                else
                {
                    $('.error_text.add').html('Заполните все поля').removeClass('hide');
                }
            },

            Add_Сatigory: function(cat_name){
                
                let err = Validate($('#add_cat_form'));
                if(err == 0)
                {
                    let post = {
                        name: cat_name
                    };

                    axios.post('/add_cat', post).then(res => {
                        let $error = $('.error_text.cat');
                        let $input = $('#add_cat_form input');
                        if(res.data.check)
                        {
                            $input.addClass('error');
                            $error.html('Такая категория уже есть в базе').removeClass('hide');
                        }
                        else
                        {
                            axios.post('/cat_api').then(res => {
                                this.cats = res.data;
                                $input.removeClass('error');
                                $error.html('Категория успешно добавлена').removeClass('hide');
                                setTimeout(function() {
                                    $error.addClass('hide');
                                    $('#add_cat_form')[0].reset();
                                }, 1000);
                            });
                        }
                    });
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

                    let post_data = {
                        id: post.id,
                        name: post.name,
                        desc: post.desc,
                        cats_id: post.cats_id
                    };

                    console.log(post_data);

                    axios.post('/update_post', post_data).then(res => {console.log(res.data)});
                }
                else
                {
                    post.error = true;
                }
            },
        },

        beforeMount() {
            this.Get_Posts(this.cur_page);
            this.Get_Cats();
        },

        components: {
			post, Form, Form_Cat, Pager, Delete_Cat_Form
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
<div class="forms_flex">
    <Form_Cat
        @Add_Cat = "Add_Сatigory"
    />

    <Delete_Cat_Form
        :cats = "cats"
        @Remove_Cat = "Remove_Cat"
    />

    <Form 
        :cats = "cats"
        @Add_Item = "Add_Item"
    />
</div>
    <post 
        v-for="item in posts" 
        :key="item.id" 
        :elem="item"
        :cats="cats"
        @remove = "Remove_Item"
        @Show_Save_Button = "Show_Save_Button"
        @save = "Save_Item"
    />

    <Pager v-if="total_posts != 0"
        :pages="pages"
        @Get_Posts = "Get_Posts"
    />
</template>

<style>
    input:focus,
    textarea:focus
    {
        outline: none;
    }
</style>