<script setup>
import { computed } from 'vue';

const props = defineProps({
  buttonStyle: String,
  text: String,
  pageLink: String,
});

// eslint-disable-next-line no-unused-vars
const getButtonStyle = computed(() => {
  switch (props.buttonStyle) {
    case "primary":
      return "primary-button";
    case "secondary":
      return "secondary-button";
    case "warning":
      return "warning-button";
    default:
      return "";
  }
});
</script>

<template>
  <div>
    <a :href="props.pageLink">
      <button
        type="button"
        :class="getButtonStyle"
        class="button"
        @click="$emit('buttonClicked')"
      >
        {{ props.text }}
      </button>
    </a>
  </div>
</template>

<style lang="scss">
.button {
  display: block;
  margin: 15px auto;
  border-radius: 15px;
}

.primary-button {
  background-color: chartreuse;
  width: 75%;
  height: 50px;
}

.secondary-button {
  background-color: darkturquoise;
  width: 50%;
  height: 30px;
}
</style>