import { createApp } from "vue";
import "./style.css";
import App from "./App.vue";
import { createPinia } from "pinia";
import router from "./routes/index";
import * as echarts from 'echarts';

const pinia = createPinia();
const app = createApp(App);
app.config.globalProperties.$echarts = echarts

app.use(pinia);
app.use(router);
app.mount("#app");
