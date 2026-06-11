import { InertiaLinkProps } from '@inertiajs/vue3';
import type { LucideIcon } from 'lucide-vue-next';

export interface Auth {
    user: User[];
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
    icon?: LucideIcon;
    isActive?: boolean;
}

export type AppPageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    sidebarOpen: boolean;
};

export type BreadcrumbItemType = BreadcrumbItem;


export interface Package {
    weight: string
    length: string
    width: string
    height: string
    package_type: string
}
export interface ShipmentJson {
    sender_id: string
    receiver_id: string
    status: string
    packages: Package[]
    description: string
}

export interface User {
    id??: string
    full_name: string
    mobile: string
    address: string
    zip_code: string
}
export interface UsersJson {
    data: User[]
    meta: {}
}
