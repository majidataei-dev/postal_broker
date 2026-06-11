import { useApi } from "@/composables/useApi";
import type { UsersJson, User } from '@/types/index'


export const UsersService = {
    async fetchUsers(): Promise<UsersJson[]> {
        const { data } = await useApi<UsersJson[]>('users', {
            method: 'get'
        });
        return data ?? [];
    },

    async addUser(payload: User): Promise<User[]> {
        const { data } = await useApi<User[]>('users', {
            method: 'post',
            body: payload
        });
        return data ?? [];
    }
}