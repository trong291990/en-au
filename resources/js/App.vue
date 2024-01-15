<template>
  <section class="text-gray-600 body-font">
    <Navigation />
    <Playlist :playlist="playlist" v-if="isHome" @go-detail="goDetail"/>
    <Player :list="currentList" v-if="!isHome" @go-home="goHome" />
  </section>
</template>
<script>
import Navigation from "./Navigation.vue";
import Playlist from "./Pages/Playlist.vue";
import Player from "./Pages/Player.vue";

export default {
  name: "App",
  components: {Navigation, Playlist, Player},
  data() {
    return {
      isHome: true,
      playlist: [],
      currentList: null
    }
  },
  methods: {
    goDetail(list) {
      this.isHome = false
      this.currentList = list
    },
    goHome() {
      this.isHome = true
    }
  },
  async mounted() {
    const data = await axios.get('/api/playlist')
    this.playlist = data.data
  },
}
</script>