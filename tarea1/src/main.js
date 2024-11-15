import { createApp } from 'vue'
import App from './App.vue'
import router from './router'  // Asegúrate de tener el archivo de rutas correctamente configurado
import 'bootstrap/dist/css/bootstrap.min.css'  // Bootstrap CSS
import 'bootstrap'  // Bootstrap JS
import './style.css'  // Estilos adicionales

const app = createApp(App)
app.use(router)  
app.mount('#app') 