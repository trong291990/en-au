<template>
  <ul class="mx-4 my-2">
    <li class="my-2" v-for="p in playlist" @click="goDetail(p)">
      <div class="flex bg-[url('/img/bg.jpg')] bg-cover rounded items-center space-x-4 p-2">
        <div class="flex-shrink-0">
          <i class='bx bx-play-circle text-5xl text-white'></i>
        </div>
        <div class="flex-1 min-w-0 text-white">
          <p class="text-sm font-medium">
            {{ p.name }}
          </p>
          <p class="text-sm truncate">
            {{ p.files.length }} songs
          </p>
        </div>
      </div>
    </li>
  </ul>
</template>

<script>
import 'axios'

export default {
  name: "Playlist",
  props: ['playlist'],
  created() {

  },
  methods: {
    goDetail(item) {
      this.$emit('go-detail', item)
    }
  }
}
</script>

<style scoped>

</style>