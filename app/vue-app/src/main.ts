import { createApp } from 'vue'
import App from './App.vue'
import Aura from '@primeuix/themes/aura';

// --- FORMA CORRETA DE IMPORTAR O PLUGIN ---
import PrimeVue from 'primevue/config';

// Importações do tema e ícones (isso estava certo)
// import 'primevue/resources/themes/aura-light-green/theme.css'; // Não funciona
import 'primeicons/primeicons.css'; // Funciona

// Seu SCSS global
// import './assets/main.scss' (não funciona)
import '../assets/main.scss' // Funciona

const app = createApp(App)

// --- Registra o plugin corretamente ---

app.use(PrimeVue, { unstyled: true });

app.mount('#app')



