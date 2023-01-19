<template>
    <div
        class="flex flex-col my-4 p-3 bg-gray-800 rounded-lg text-white">
        <div class="flex flex-col space-y-2 break-words">
          <p class="font-semibold lg:text-xl">
            {{ user.name }}
          </p>
            <base-button class="flex justify-end" @click="$emit('add-friend', user.id)">
                <img class="px-2" src="https://img.icons8.com/ios-filled/25/FFFFFF/plus--v1.png"/>
            </base-button>
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
