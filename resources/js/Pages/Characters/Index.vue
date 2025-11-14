<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    charactersData: {
        type: Object,
        default: () => ({ results: [] }),
    },
    currentPage: {
        type: Number,
        default: 1,
    },
    propTest: {
        type: String,
    },
});

const characters = ref(props.charactersData.results);
const nextPage = ref(parseInt(props.currentPage) + 1);
const prevPage = ref(parseInt(props.currentPage) - 1);

</script>

<template>
    <Head title="Personajes" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Personajes
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ propTest }}
                    </div>
                    <div v-for="character in characters" :key="character.id">
                        <strong>{{ character.name }}</strong>
                        <p>{{ character.age }}</p>
                    </div>
                    <div>
                        <a v-if="prevPage >= 1" :href="route('characters.index', {page: prevPage})" class="text-blue-500 hover:underline mt-4 block">Anterior</a>
                        <span>{{ currentPage }}</span>
                        <a :href="route('characters.index', {page: nextPage})" class="text-blue-500 hover:underline mt-4 block">Siguiente</a>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>