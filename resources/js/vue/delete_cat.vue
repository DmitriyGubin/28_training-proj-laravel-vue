<script>

    export default {
        props: ['cats'],
        emits: ['Remove_Cat'],
        data() {
            return {
                
            }
        }
    }

</script>

<template>

    <form>
        <h2 class="form_title">Удалить категорию</h2>
        <div class="cat_box">
            <div class="cat_item" v-for="elem in cats" :key="elem.id">
                <div class="cat_name">{{ elem.name }}</div>
                <button class="del_butt" @click.prevent="$emit('Remove_Cat', elem.id)">Удалить</button>
            </div>
        </div>
    </form>

</template>
