<template>
    {{tours}}
</template>

<script>
export default {

    data() {
        return {
            tours: [],
        }
    },

    methods: {
        getTours() {
            axios.get('/api/tours').then(response => {
                this.tours = response.data.data
            })
        }
    },

    mounted() {
        this.getTours();
    }
}
</script>

