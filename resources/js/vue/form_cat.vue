<script>

    export default {
        emits: ['Add_Cat'],
        data() {
            return {
                cur_cat_name: null
            }
        }
    }

</script>

<template>

    <form id="add_cat_form">
        <div>
            <h2 class="form_title">Добавить категорию</h2>
            <input class="required" type="text" placeholder="Название категории" v-model="cur_cat_name">
        </div>
        
        <div>
            <button @click.prevent="$emit('Add_Cat', cur_cat_name)" id="add_cat">Добавить категорию</button>
            <div class="error_text hide cat"> Такая категори уже есть в базе </div>
        </div>
    </form>

</template>
