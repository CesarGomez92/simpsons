<script setup>
import Card from '@/Components/Card.vue';
import Status from '@/Components/Status.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
  charactersData: {
    type: Object,
    default: () => ({ results: [] }),
  },  
  currentPage: [Number, String],

  propTest: {
    type: String,
  },
});


const nextPage = ref(parseInt(props.currentPage) + 1);

const prevPage = ref(parseInt(props.currentPage) - 1);

const imgSise = 500;

const filteredPhrase = (phrases) => {
  return phrases.filter(f => f.trim().split(/\s+/).length <= 3).slice(0, 3);
};
const longPhrases = (phrases) => {
  return phrases?.filter(f => f.trim().split(/\s+/).length > 3) ?? []
}

const remainingPhrasesCount = (phrases) => {
  const total = phrases?.length ?? 0
  const shown = filteredPhrase(phrases).length
  return total - shown
}


const showModal = ref(false);
const selectedCharacter = ref(null);

const openModal = (character) => {
  selectedCharacter.value = character;
  showModal.value = true;
};

const closeModal = () => {
  showModal.value = false;
  selectedCharacter.value = null;
};
</script>

<template >
  <Head title="Personajes" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Personajes
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
          <Card :charactersData="charactersData" @select="openModal">
            <template v-slot="{ character }">
                <div class="shadow-lg w-[130px] p-2">
                    <img class="w-[128px]" :src="`https://cdn.thesimpsonsapi.com/${imgSise}${character.portrait_path}`" alt="">
                  </div>
                  <div class="pt-4">
                      <strong>{{ character.name }}</strong>
                      <p class="text-sm">{{ character.occupation }}</p>
                      <Status 
                      class="pt-2"
                      :character="character"
                    />
                  </div>
                  <ul class="flex flex-col gap-1 text-sm">
                      <li v-for="(phrase, index) in filteredPhrase(character.phrases)" :key="index">
                          {{ phrase }}
                      </li>
                      <li class="text-xs text-gray-500">+ {{ remainingPhrasesCount(character.phrases) }} frases</li>
                  </ul>     
            </template>
          </Card>
            

          <div class="col-span-full flex justify-between mt-6">
            <a v-if="prevPage >= 1" :href="route('characters.index', { page: prevPage })" class="text-blue-500 hover:underline">Anterior</a>
            <span class="font-semibold">Página {{ currentPage }}</span>
            <a :href="route('characters.index', { page: nextPage })" class="text-blue-500 hover:underline">Siguiente</a>
          </div>
        </div>
      </div>
    </div>

    <transition name="fade">
        <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg max-w-md w-full shadow-xl relative overflow-y-auto max-h-[90vh]">
            <button @click="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl">✕</button>
      
            <h3 class="text-lg font-bold mb-2">{{ selectedCharacter?.name }}</h3>
            <p><strong>Cumpleaños:</strong> {{ selectedCharacter?.birthdate }}</p>
            <p><strong>Género:</strong> {{ selectedCharacter?.gender }}</p>

            <p class="mt-4 font-semibold">Frases restantes:</p>
            <ul class="list-disc pl-5 text-sm">
                <li v-for="(phrase, index) in longPhrases(selectedCharacter?.phrases)" :key="index">
                {{ phrase }}
                </li>
            </ul>
            </div>
        </div>
    </transition>

  </AuthenticatedLayout>
</template>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.3s ease;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
</style>