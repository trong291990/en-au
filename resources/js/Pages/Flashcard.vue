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
          <p><b>IAP: </b>{{ list[currentIndex]?.properties[0]?.plainText }}</p>
          <p><b>English: </b>{{ list[currentIndex]?.properties[1]?.plainText }}</p>
          <p><b>Type: </b>{{ list[currentIndex]?.properties[7]?.rawContent?.name }}</p>
          <p><b>Gợi ý: </b>{{ list[currentIndex]?.properties[2]?.plainText }}</p>
        </div>
      </div>
      <!-- Music Controls -->
      <div class="mt-6 flex justify-center items-center">
        <button @click="prev" class="p-3 rounded-full bg-gray-200 hover:bg-gray-300 focus:outline-none">
          <svg width="64px" height="64px" viewBox="0 0 24 24" class="w-4 h-4 text-gray-600" fill="none" xmlns="http://www.w3.org/2000/svg" transform="matrix(-1, 0, 0, 1, 0, 0)">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
              <path d="M16.6598 14.6474C18.4467 13.4935 18.4467 10.5065 16.6598 9.35258L5.87083 2.38548C4.13419 1.26402 2 2.72368 2 5.0329V18.9671C2 21.2763 4.13419 22.736 5.87083 21.6145L16.6598 14.6474Z" fill="#000000"></path>
              <path d="M22.75 5C22.75 4.58579 22.4142 4.25 22 4.25C21.5858 4.25 21.25 4.58579 21.25 5V19C21.25 19.4142 21.5858 19.75 22 19.75C22.4142 19.75 22.75 19.4142 22.75 19V5Z" fill="#000000"></path>
            </g>
          </svg>
        </button>
        <button @click="play" class="rounded-full w-[56px] h-[56px] bg-gray-200 hover:bg-gray-300 focus:outline-none mx-4">
          <i class="bx bx-volume-full text-[50px] pl-1 text-black"></i>
        </button>
        <button @click="this.showAnswer = !this.showAnswer" class="rounded-full w-[56px] h-[56px] bg-gray-200 hover:bg-gray-300 focus:outline-none mx-4">
          <i class="bx bx-low-vision text-[50px] pl-1 text-black"></i>
        </button>
        <button @click="next" class="p-3 rounded-full bg-gray-200 hover:bg-gray-300 focus:outline-none">
          <svg width="64px" height="64px" viewBox="0 0 24 24" class="w-4 h-4 text-gray-600" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
              <path d="M16.6598 14.6474C18.4467 13.4935 18.4467 10.5065 16.6598 9.35258L5.87083 2.38548C4.13419 1.26402 2 2.72368 2 5.0329V18.9671C2 21.2763 4.13419 22.736 5.87083 21.6145L16.6598 14.6474Z" fill="#000000"></path>
              <path d="M22.75 5C22.75 4.58579 22.4142 4.25 22 4.25C21.5858 4.25 21.25 4.58579 21.25 5V19C21.25 19.4142 21.5858 19.75 22 19.75C22.4142 19.75 22.75 19.4142 22.75 19V5Z" fill="#000000"></path>
            </g>
          </svg>
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
      const voices = window.speechSynthesis.getVoices();
      if (voices.length > 0) {
        // Select the first voice, or customize selection logic as needed
        utterance.voice = voices[0];
      }

      // Speak the text
      window.speechSynthesis.speak(utterance);
    }
  }
}
</script>

<style scoped>

</style>