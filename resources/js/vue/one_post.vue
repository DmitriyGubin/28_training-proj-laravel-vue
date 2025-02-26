<script>

    export default {
        props: ['elem','cats'],
        emits: ['remove', 'Show_Save_Button', 'save']
    }

</script>

<template>
    <div class="post_item">
        <div class="post_wrap">
            <div class="post_name">Пост {{ elem.id }}</div>
            <input :class="{error: (elem.name == '')}" @input="$emit('Show_Save_Button', elem)" type="text" name="name" placeholder="Название" v-model="elem.name">
            <textarea :class="{error: (elem.desc == '')}" @input="$emit('Show_Save_Button', elem)" name="descr" placeholder="Описание поста" v-model="elem.desc"></textarea>
            
            <select @change="$emit('Show_Save_Button', elem)" class="cat_select" v-model="elem.cats_id">
                <option selected v-show="elem.cats_id == null">Выберите категорию</option>
                <option :selected="item.id == elem.cats_id" :value="item.id" v-for="item in cats">{{ item.name }}</option>
            </select>

            <transition name="fade">
                <button @click="$emit('save', elem)" v-show="elem.save" class="save_button">Сохранить</button>
            </transition>
            <button class="delete_button" @click="$emit('remove', elem.id)">Удалить</button>
            <div v-show="elem.error" class="error_text">Заполните все поля</div>
        </div>
    </div>

</template>


<style>

.fade-enter-active,
.fade-leave-active {
  transition: opacity 1s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}


</style>
