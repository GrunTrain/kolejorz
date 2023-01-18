<template>
    <div class="w-full lg:w-5/6 p-5 h-3/4 lg:pl-60 flex justify-center lg:block">
        <div class="w-full sm:w-2/3 lg:w-2/3 xl:w-1/2 p-4 bg-gray-800 rounded-lg shadow-md p-8">
            <form @submit.prevent class="space-y-6">
                <h1 class="text-xl font-medium text-white justify-center">Zmiana hasła</h1>

                <div>
                    <label class="block mb-2 text-sm font-medium text-white">Nowe hasło</label>
                    <input autocomplete="on" type="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" v-model.trim="password" required>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-white">Powtórz hasło</label>
                    <input autocomplete="on" type="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" v-model.trim="password_repeat">
                </div>

                <span v-if="error" class="break-words" style="color: red">{{ error }}</span>

                <div class="bottom-0 flex justify-start w-fit">
                    <button @click="changePassword" class="top-10 w-full text-white bg-yellow-600 hover:bg-yellow-500 font-semibold rounded-lg text-sm px-5 py-3 text-center">Zmień hasło</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import AlertPopUp from "./AlertPopUp.vue";

export default {
    components: {
        AlertPopUp
    },

    data() {
        return {
            password: '',
            password_repeat: '',
            error: '',
            alert: '',
        }
    },

    emits: ['set-component'],

    methods: {
        changePassword() {
            if ((this.password === this.password_repeat) && (this.password.length >= 8)) {
                axios.put('/api/profile/id', {
                    data: {
                        password: this.password
                    }
                }).catch().finally(() => {
                    this.password = '';
                    this.password_repeat = '';
                })
                this.$flashMessage.show({
                    type: 'info',
                    time: 2000,
                    text: "Hasło zostało zmienione!",
                    image: 'https://img.icons8.com/ios/50/1087c2/steam-engine.png',
                });
                this.error = '';
            } else {
                if (this.password !== this.password_repeat) {
                    this.error = '';
                    this.error = 'Podane hasła nie są takie same!';
                }
                if (this.password.length < 8) {
                    this.error = '';
                    this.error = 'Podane hasło musi składać się z min. 8 znaków!';
                }
            }
        },

        showAlert(alert) {
            this.alert = alert;
            setTimeout(this.hideAlert, 2000);
        },

        hideAlert() {
            this.alert = '';
        }
    }
}
</script>
