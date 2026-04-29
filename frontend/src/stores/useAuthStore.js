import { defineStore } from 'pinia';

export const useAuthStore = defineStore('Auth', {
    state: () => ({
        auth: {
            check: false,
            firstname: null,
            middlename: null,
            lastname: null,
            email: null,
            date_of_birth: null,
            profile: {
                pfp: null,
                banner: null,
                main_medium: null,
            }
        },
        token: null
    }),

    actions: {
        register(user, token) {
            this.token = token;
            this.auth.check = true;
            this.auth.firstname = user.firstname;
            this.auth.middlename = user.middlename;
            this.auth.lastname = user.lastname;
            this.auth.email = user.email;
            this.auth.date_of_birth = user.date_of_birth;
            this.auth.profile.pfp = user.profile?.pfp ?? null;
            this.auth.profile.banner = user.profile?.banner ?? null;
            this.auth.profile.main_medium = user.profile?.main_medium ?? null;
        },

        logout() {
            this.token = null;
            this.auth.check = false;
            this.auth.firstname = null;
            this.auth.middlename = null;
            this.auth.lastname = null;
            this.auth.email = null;
            this.auth.date_of_birth = null;
            this.auth.profile.pfp = null;
            this.auth.profile.banner = null;
            this.auth.profile.main_medium = null;
        }
    },

    getters: {
        fullname: (state) => {
            const parts = [
                state.auth.firstname,
                state.auth.middlename,
                state.auth.lastname
            ].filter(Boolean);
            return parts.join(' ') || null;
        },

        isAuthenticated: (state) => state.auth.check && !!state.token,

        pfp: (state) => state.auth.profile.pfp ?? '/default-pfp.png',

        banner: (state) => state.auth.profile.banner ?? '/default-banner.png',

        initials: (state) => {
            const f = state.auth.firstname?.[0] ?? '';
            const l = state.auth.lastname?.[0] ?? '';
            return (f + l).toUpperCase() || null;
        },
    }
});