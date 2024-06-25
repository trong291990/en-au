<template>
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
        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Today</span>
      </label>
    </div>
    <div class="flex justify-center items-center">
      <div class="w-80">
        <select v-model="flashcard" @change="loadWords" id="flashcards" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          <option value="07b5a0a6a71d46be8dbbce3a71e35395">Tiếng Anh hằng ngày</option>
          <option value="fb042730d03648e2b504d63840474871">Bảng chữ cái Tiếng Nhật</option>
        </select>
      </div>
    </div>
    <Flashcard :list="words" />
  </section>
</template>
<script>
import Flashcard from "./Pages/Flashcard.vue";

export default {
  name: "App",
  components: {Flashcard},
  data() {
    return {
      words: [],
      flashcard: null,
      today: false,
      loading: true
    }
  },
  methods: {
    async loadWords() {
      this.loading = true;
      localStorage.setItem('flashcard', this.flashcard);
      const data = await axios.get(`/api/flashcard/${this.flashcard}`, {
        params: {
          today_only: this.today
        }
      })
      this.words = data.data;
      this.loading = false;
    }
  },
  mounted() {
    this.flashcard = localStorage.getItem('flashcard') || '07b5a0a6a71d46be8dbbce3a71e35395';
    this.loadWords()
  },
}
</script>