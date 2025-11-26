<template>
    <div class="flex justify-center mb-[10px]">
        <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 font-semibold text-xs">
            {{ character.age }}
        </span>
        <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 font-semibold text-xs bg-green-50 text-green-700">
            {{ character.status }}
        </span>
    </div>
</template>

<script setup>
const props = defineProps({
  character: {
    type: Object,
    required: true,
  }
});
</script>
