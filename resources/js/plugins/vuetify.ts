import { createApp } from 'vue'

// Vuetify
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

import { en, fa, ar, tr } from 'vuetify/locale'

const Vuetify = createVuetify({
    components,
    directives,
    locale:{
        locale: 'en',
        messages:{
            en, fa, ar, tr
        },
        rtl:{ fa: true, ar: true }
    },
    theme: {
        defaultTheme: 'dark',
        themes: {
            light: {
                colors: {
                    background: "#f3f5f7",
                    primary: "#202569",
                    secondary: "#0288d1",
                    surface: "#ffffff",
                    error: "#d32f2f",
                    success: "#388e3c",
                    warning: "#f57c00",
                    info: "#0288d1",
                    overlay: "#04171a",
                    "on-primary": "#ffffff",
                    "on-secondary": "#ffffff",
                    "on-background": "#000000",
                    "on-surface": "#000000",
                    "on-overlay": "#000000",
                    "on-warning": "#000000"
                }
            },
            dark: {
                colors: {
                    // background: "#121212",
                    background: "#f3f5f7",
                    primary: "#3399ff",
                    secondary: "#F7BB53",
                    // secondary: "#FFD700",
                    // secondary: "#EECE37",
                    // surface: "#1e1e1e",
                    // surface: "#050417ff",
                    surface: "#0b1f37ff",
                    error: "#ef5350",
                    success: "#66bb6a",
                    warning: "#f7bb53",
                    info: "#29b6f6",
                    overlay: "#04171a",
                    "on-primary": "#000000",
                    "on-secondary": "#000000",
                    "on-background": "#000000",
                    "on-surface": "#ffffff",
                    "on-overlay": "#FFFFFF",
                    "on-warning": "#000000"

                }
            }
        }
    }
})

export default Vuetify