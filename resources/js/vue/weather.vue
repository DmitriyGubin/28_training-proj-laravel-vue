<script>

    import axios from 'axios';

    export default {
        data() {
            return {
                lat: '',
                long: '',
                result: null,
                cur_cour: (new Date()).getHours()
            }
        },
        computed: {
            api_url: function() {
                return `https://api.open-meteo.com/v1/forecast?latitude=${this.lat}&longitude=${this.long}&hourly=temperature_2m&forecast_days=1`
            },
            check_form: function(){
                return (this.lat !== '') && (this.long !== '');
            },
            temp: function(){
                return 'Температура: ' + this.result[this.cur_cour]
            }
        },
        methods: {
            Get_Weather: function() {
                axios.get(this.api_url).then(res => {
                      this.result = res.data.hourly.temperature_2m;
                });
            }
        }
    }
</script>

<template>
    <form novalidate @submit.prevent="Get_Weather">
        <h2 class="form_title">Узнать погоду</h2>
        <input v-model="lat" type="number" placeholder="Введите широту" step="0.1">
        <input v-model="long" type="number" placeholder="Введите долготу" step="0.1">
        <transition name="fade">
            <button v-show="this.check_form">Узнать</button>
        </transition>
        <transition name="fade">
            <div class="temp_res" v-if="result !== null">
                {{ temp }}
            </div>
        </transition>
    </form>
</template>



