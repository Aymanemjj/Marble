import { defineStore } from 'pinia';
import axiosClient from '../axios';

export const useAuthStore = defineStore('Auth', {
    state: () => ({
        auth: {
            check: false,
            id: null,
            role: null,
            firstname: null,
            middlename: null,
            lastname: null,
            email: null,
            date_of_birth: null,
            main_medium: null,
            profile: {
                picture: null,
                banner: null,
                biography: null,
                fav_piece_1: null,
                fav_piece_2: null,
            },
        },
        token: localStorage.getItem('token') || null,
    }),

    actions: {
        async initialize(token) {
            if (this.auth.check) return;

            try {
                const { data } = await axiosClient.get('/profile/pinia');
                this.register(data.data.user);
            } catch (err) {
                console.error(err);
            }
        },

        register(user) {
            this.auth.check = true;
            this.auth.id = user.id ?? null
            this.auth.role = user.role ?? null
            this.auth.firstname = user.firstname ?? null;
            this.auth.middlename = user.middlename ?? null;
            this.auth.lastname = user.lastname ?? null;
            this.auth.email = user.email ?? null;
            this.auth.date_of_birth = user.date_of_birth ?? null;
            this.auth.main_medium = user.main_medium ?? null;

            this.auth.profile.picture = user.profile?.picture ?? null;
            this.auth.profile.banner = user.profile?.banner ?? null;
            this.auth.profile.biography = user.profile?.biography ?? null;
            this.auth.profile.fav_piece_1 = user.profile?.fav_piece_1 ?? null;
            this.auth.profile.fav_piece_2 = user.profile?.fav_piece_2 ?? null;

        },

        logout() {
            this.auth.check = false;
            this.auth.id = null,
            this.auth.role =  null
            this.auth.firstname = null;
            this.auth.middlename = null;
            this.auth.lastname = null;
            this.auth.email = null;
            this.auth.date_of_birth = null;
            this.auth.main_medium = null;

            this.auth.profile.picture = null;
            this.auth.profile.banner = null;
            this.auth.profile.biography = null;
            this.auth.profile.fav_piece_1 = null;
            this.auth.profile.fav_piece_2 = null;

            this.token = null;
            localStorage.removeItem('token');
        },
    },

    getters: {
        fullname: (state) => {
            const parts = [
                state.auth.firstname,
                state.auth.middlename,
                state.auth.lastname,
            ].filter(Boolean);
            return parts.join(' ') || null;
        },
        isAuthenticated: (state) => state.auth.check && !!state.token,
        isAdmin: (state) => state.auth.role === 'admin',
        picture: (state) => state.auth.profile.picture ?? '/default-pfp.png',
        banner: (state) => state.auth.profile.banner ?? '/default-banner.png',
        initials: (state) => {
            const f = state.auth.firstname?.[0] ?? '';
            const l = state.auth.lastname?.[0] ?? '';
            return (f + l).toUpperCase() || null;
        },
    },
});