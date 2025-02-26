<script>

    export default {
        props: ['pages'],
        emits: ['Get_Posts']
    }

</script>

<template>
    <div class="pager_box">
        <div :class="{active: (item.active == true), pager_item: true}" @click="$emit('Get_Posts', item.num)" v-for="item in this.pages">
            {{ item.num }}
        </div>
    </div>
</template>



