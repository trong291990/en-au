<template>
  <div class="bg-gray-100 px-1 pb-4 pt-1 flex justify-center items-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-80">
      <p class="text-center">
        <label v-if="list.length" class="font-bold bg-black text-white p-1 rounded">{{ currentIndex + 1 }}/{{ list.length }}</label>
        <label v-else>__</label>
      </p>
      <h2 class="text-xl font-bold text-center pt-1">{{ list[currentIndex]?.title }}</h2>
      <div class="mt-2 mb-2 min-h-[96px]">
        <div v-show="showAnswer">
          <p><b>Phiên âm: </b>{{ list[currentIndex]?.properties[0]?.plainText }}</p>
          <p><b>Từ: </b><label class="underline decoration-solid">{{ list[currentIndex]?.properties[1]?.plainText }}</label></p>
          <p><b>Loại: </b>{{ list[currentIndex]?.properties[7]?.rawContent?.name }}</p>
          <p><b>Gợi ý: </b><i>{{ list[currentIndex]?.properties[2]?.plainText }}</i></p>
          <p><b>Ví dụ: </b>{{ list[currentIndex]?.properties[8]?.plainText }}</p>
        </div>
      </div>
      <!-- Music Controls -->
      <div class="mt-6 flex justify-center items-center">
        <button @click="prev" class="rounded-full bg-gray-200 hover:bg-gray-300 focus:outline-none">
          <i class="bx bx-chevron-left text-[30px] p-1 text-black"></i>
        </button>
        <button @click="play" class="rounded-full w-[46px] h-[46px] bg-gray-200 hover:bg-gray-300 focus:outline-none mx-4">
          <i class="bx bx-volume-full text-[40px] pl-1 text-black"></i>
        </button>
        <button @click="this.showAnswer = !this.showAnswer" class="rounded-full w-[46px] h-[46px] bg-gray-200 hover:bg-gray-300 focus:outline-none mx-4">
          <i class="bx bx-low-vision text-[40px] pl-1 text-black"></i>
        </button>
        <button @click="remove(currentIndex)" class="rounded-full w-[46px] h-[46px] bg-gray-200 hover:bg-gray-300 focus:outline-none mx-4">
          <i class="bx bx-minus text-[40px] pl-1 text-black"></i>
        </button>
        <button @click="next" class="rounded-full bg-gray-200 hover:bg-gray-300 focus:outline-none">
          <i class="bx bx-chevron-right text-[30px] p-1 text-black"></i>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import cover from '../../img/cover.jpg';
import {slugify} from "../util.js";
export default {
  name: "Flashcard",
  props: ['list'],
  data() {
    return {
      currentIndex: 0,
      showAnswer: false,
      audio: new Audio(),
      isPlaying: false,
      interval: null,
      autoPlay: false
    }
  },
  created() {
    window.addEventListener('keydown', (e) => {
      console.log('key', e)
      if (e.code === 'Space') {
        if (this.isPlaying) {
          this.audio.pause()
          this.isPlaying = false
        } else {
          this.isPlaying = true
          this.audio.play()
        }
      } else if (e.code === 'ArrowRight') {
        this.next()
      } else if (e.code === 'ArrowLeft') {
        this.prev()
      } else if (e.key === 'MediaPlayPause') {
        this.next()
      }
    });
  },
  mounted() {

  },
  methods: {
    play() {
      const text = this.list[this.currentIndex]?.properties[1]?.plainText
      if (text) {
        this.speak(text)
      }
    },
    remove(index) {
      this.list.splice(index, 1)
    },
    next() {
      if (this.list.hasOwnProperty(this.currentIndex + 1 )) {
        this.showAnswer = false;
        this.currentIndex += 1;
      }
    },
    prev() {
      if (this.list.hasOwnProperty(this.currentIndex - 1 )) {
        this.showAnswer = false;
        this.currentIndex -= 1;
      }
    },
    speak(text) {
      if (text === '') {
        return;
      }

      const utterance = new SpeechSynthesisUtterance(text);

// Optionally, set voice properties
      utterance.rate = 0.8; // Speed of speech (0.1 to 10)
      utterance.pitch = 1; // Pitch (0 to 2)
      utterance.volume = 1; // Volume (0 to 1)

// Optionally, select a specific voice
      function setVoice() {
        const voices = window.speechSynthesis.getVoices();
        if (voices.length > 0) {
          // You can filter voices based on language, name, etc.
          const selectedVoice = voices.find(voice => voice.lang === 'en-US'); // Select English (US) voice
          if (selectedVoice) {
            utterance.voice = selectedVoice;
          } else {
            // Fallback to the first voice if no specific voice found
            utterance.voice = voices[0];
          }
        }
      }

     // Set voice when voices are loaded
      if (window.speechSynthesis.getVoices().length > 0) {
        setVoice();
      } else {
        window.speechSynthesis.onvoiceschanged = setVoice;
      }

      // Speak the text
      window.speechSynthesis.speak(utterance);
    }
  }
}
</script>

<style scoped>

</style>