<script setup>
import { reactive } from "vue";
import Button from "./components/Button.vue";

const user = reactive({
  username: null,
  password: null,
});

const loginUser = () => {
  console.log("hij doet iets");
  return 5;
};
</script>

<template>
  <h1>You can login now!</h1>
  <h3>If you know your credentials ofcourse :)</h3>
  <form id="login-form">
    <input type="text" :value="user.username" placeholder="Username" required />
    <input
      type="password"
      :value="user.password"
      placeholder="Password"
      required
    />
  </form>
  <Button
    buttonStyle="primary"
    text="Login"
    @buttonClicked="loginUser"
    pageLink="#"
  />
</template>
