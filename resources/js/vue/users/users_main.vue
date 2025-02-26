<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                users: null
            }
        },
        methods: {
            Get_Users: function(page) {
                axios.post('/users_api').then(res => {
                    this.users = res.data;
                    for(let item of this.users)
                    {
                        if(item.role == 1)
                        {
                            item.role = true;
                        }
                        else
                        {
                            item.role = false;
                        }
                    }
                })
            },
            Save_status: function(this_id, this_role)
            {
                let post_data = { 'id': this_id, 'role': this_role};
                axios.post('/update_user', post_data).then(res => {
                    console.log(res.data);
                });
            }
        },
        beforeMount() {
            this.Get_Users();
        },
    }

</script>

<template>

    <div class="user_item" v-for="item in users" :key="item.id">
        <div class="us_name">Логин: {{ item.login }}</div>
        <div class="check_box">
            <span class="check_title">Является ли админом</span>
            <input @change="Save_status(item.id,item.role)" type="checkbox" v-model="item.role">
        </div>
    </div>

</template>
