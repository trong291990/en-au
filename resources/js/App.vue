<template>
  <!-- Loading Overlay -->
  <!-- Loading Overlay -->
  <div v-if="loading" class="fixed inset-0 bg-gray-800 bg-opacity-50 z-50 flex items-start justify-center pt-12">
    <div class="absolute top-[50px] flex items-center space-x-2">
      <svg class="animate-spin h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
      </svg>
      <span class="text-white text-lg">Loading...</span>
    </div>
  </div>
  <section class="text-gray-600 body-font">
    <div class="text-center pt-4">
      <label class="relative inline-flex items-center cursor-pointer">
        <input type="checkbox" v-model="today" @change="loadWords" class="sr-only peer">
        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Today words only</span>
      </label>
    </div>
    <Flashcard :list="words" />
  </section>
</template>
<script>
import Flashcard from "./Pages/Flashcard.vue";

export default {
  name: "App",
  components: {Flashcard, Navigation},
  data() {
    return {
      words: [],
      today: false,
      loading: true
    }
  },
  methods: {
    async loadWords() {
      this.loading = true;
      const data = await axios.get('/api/flashcard', {
        params: {
          today_only: this.today
        }
      })
      this.words = data.data;
      this.loading = false;
    }
  },
  mounted() {
    this.loadWords()
  },
}
</script>