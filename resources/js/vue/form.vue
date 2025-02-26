<script>

    export default {
        props: ['cats'],
        emits: ['Add_Item'],
        data() {
            return {
                cur_post_name: null,
                cur_post_descr: null,
                selected_cat: null
            }
        }
    }

</script>

<template>

    <form id="add_post_form" @submit.prevent="$emit('Add_Item',cur_post_name, cur_post_descr, selected_cat)">
        <h2 class="form_title">Добавить пост</h2>
        <input class="required" type="text" placeholder="Название поста" v-model="cur_post_name">
        <textarea class="required" placeholder="Описание поста" v-model="cur_post_descr"></textarea>

        <div class="cat_title">Категория</div>
        <select class="cat_select" v-model="selected_cat">
            <option :value="elem.id" v-for="elem in cats">{{ elem.name }}</option>
        </select>

        <button>Добавить пост</button>
        <div class="error_text add hide">
            Заполните все поля
        </div>
    </form>

</template>
