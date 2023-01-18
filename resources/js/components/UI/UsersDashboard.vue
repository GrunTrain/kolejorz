<template>
    <div
        class="flex flex-col my-4 p-3 bg-gray-800 rounded-lg text-white">
        <div class="flex flex-col space-y-2 break-words">
              <p class="font-semibold lg:text-xl">
                {{ user.name }}
              </p><base-button @click="$emit('add-friend', user.id)">+</base-button>
        </div>
    </div>

</template>

<script>

export default {
    props: ['user'],

    data() {
        return {
        }
    },
    emits: ['add-friend'],
}
</script>
