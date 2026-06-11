import { PackagesServices } from "@/services/packages";
import { PackagesJson } from "@/types";
import { defineStore } from "pinia";

export const usePackagesStore = defineStore('packages',{
    state: () => ({
        packages: [] as PackagesJson[]
    }),
    getters:{},
    actions:{

        async allPackages(){
            try {
                const { data, error } = await PackagesServices.fetchPackages()
                if (data) {
                    this.packages = data
                }
            } catch (error) {
                return error
            }
        }
    }
})