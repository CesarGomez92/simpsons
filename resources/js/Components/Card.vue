<script setup>
import { ref } from 'vue';


const props = defineProps({
  charactersData: {
    type: Object,
    default: () => ({ results: [] }),
  },

});

const characters = ref(props.charactersData.results);


const emit = defineEmits(['select'])

const handleClick = (character) => {
  emit('select', character)
}



</script>
<template>
    <div v-for="character in characters" :key="character.id">
        
        <div @click="handleClick(character)" class="rounded-lg border p-4 flex flex-col items-center bg-white shadow-sm text-center transition-all duration-300 group cursor-pointer hover:scale-105 hover:shadow-xl hover:shadow-yellow-200 hover:border-yellow-400 hover:bg-yellow-50">
            <slot :character="character" />
        </div>
    </div>
</template>


<style lang="scss" scoped>

</style>