const Home = () => import('./components/Home.vue')
const Contacto = () => import('./components/Contacto.vue')

const Mostrar = () => import('./components/ambientes/Mostrar.vue')
const Crear = () => import('./components/ambientes/Crear.vue')
const Editar = () => import('./components/ambientes/Editar.vue')

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'contacto',
        path: '/contacto',
        component: Contacto
    },
    {
        name: 'mostrarambiente',
        path: '/ambientes',
        component: Mostrar
    },
    {
        name: 'crearambiente',
        path: '/crear',
        component: Crear
    },
    {
        name: 'editarambiente',
        path: '/editar/:id',
        component: Editar
    }
]