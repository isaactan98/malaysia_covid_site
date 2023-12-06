<template>
    <div class="grid grid-cols-12 gap-4 mt-5 h-full w-full">
        <div class="col-span-12 md:col-span-8 gap-5 grid">
            <UCard>
                <template #header>
                    <div class="block md:flex justify-between">
                        <div class="text-sm">Malaysia Covid-19 Tracker</div>
                        <div v-if="allCases != null" class="text-xs mt-2 md:mt-0">
                            Last Updated: {{ allCases[allCases.length - 2]?.date }}
                        </div>
                    </div>
                </template>
                <div class="grid grid-cols-3 gap-5">
                    <div class="flex flex-col justify-center items-center">
                        <div class="text-2xl md:text-3xl font-bold flex gap-1 items-center">
                            {{ allCases[allCases.length - 2]?.cases_new }}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4"
                                v-if="allCases[allCases.length - 2]?.cases_new > allCases[allCases.length - 3]?.cases_new">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.5 12.75l7.5-7.5 7.5 7.5m-15 6l7.5-7.5 7.5 7.5" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4" v-else>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 5.25l-7.5 7.5-7.5-7.5m15 6l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                        <div class="text-xs">New Cases</div>
                    </div>
                    <div class="flex flex-col justify-center items-center">
                        <div class="text-2xl md:text-3xl font-bold">
                            {{ allCases[allCases.length - 2]?.cases_active }}
                        </div>
                        <div class="text-xs">Active Cases</div>
                    </div>
                    <div class="flex flex-col justify-center items-center">
                        <div class="text-2xl md:text-3xl font-bold">
                            {{ allCases[allCases.length - 2]?.cases_recovered }}
                        </div>
                        <div class="text-xs">Recovered</div>
                    </div>
                    <div class="flex flex-col justify-center items-center">
                        <div class="text-2xl md:text-3xl font-bold">
                            {{ allCases[allCases.length - 2]?.cases_death ?? 'N/A' }}
                        </div>
                        <div class="text-xs">Deaths</div>
                    </div>
                    <div class="flex flex-col justify-center items-center">
                        <div class="text-2xl md:text-3xl font-bold">
                            {{ allCases[allCases.length - 2]?.cases_import }}
                        </div>
                        <div class="text-xs">Imported Cases</div>
                    </div>
                    <div class="flex flex-col justify-center items-center">
                        <div class="text-2xl md:text-3xl font-bold">
                            {{ allCases[allCases.length - 2]?.cases_cluster }}
                        </div>
                        <div class="text-xs">Cluster</div>
                    </div>
                </div>
                <div class="mt-5">
                    <div class="text-xs text-zinc-500">
                        *Cases reported in the 24h since the last report (except for 16th
                        March 2020, for which the data is cumulative)
                    </div>
                    <span></span>
                </div>
            </UCard>
            <UCard>
                <template #header>
                    <div class="flex justify-between">
                        <div class="text-sm">Vaccination Progress</div>
                        <!-- <div class="text-xs">View All</div> -->
                    </div>
                </template>
                <div class="block md:grid grid-cols-3 gap-5">
                    <div class="flex flex-col justify-center items-center mb-3">
                        <div class="text-2xl md:text-3xl font-bold flex gap-1 items-center">
                            {{ allVacc[allVacc.length - 2]?.daily }}
                        </div>
                        <div class="text-xs">Daily Dose</div>
                    </div>
                    <div class="flex flex-col justify-center items-center mb-3">
                        <div class="text-2xl md:text-3xl font-bold">
                            {{ allVacc[allVacc.length - 2]?.cumul }}
                        </div>
                        <div class="text-xs">Fully Vacc.</div>
                    </div>
                    <div class="flex flex-col justify-center items-center mb-3">
                        <div class="text-2xl md:text-3xl font-bold">
                            {{ allVacc[allVacc.length - 2]?.cumul }}
                        </div>
                        <div class="text-xs">Partially Vacc.</div>
                    </div>
                </div>
            </UCard>
            <UCard>
                <template #header>
                    <div class="flex justify-between">
                        <div class="text-sm">State Cases</div>
                        <!-- <div class="text-xs">View All</div> -->
                    </div>
                </template>
            </UCard>
        </div>
        <div class=" col-span-12 md:col-span-4">
            <UCard>
                <template #header>
                    <div class="flex justify-between">
                        <div class="text-sm">News Feed</div>
                        <!-- <div class="text-xs">View All</div> -->
                    </div>
                </template>
            </UCard>
        </div>
    </div>
</template>

<script>
import { parseCsv } from '../composables/parseCsv'

export default {
    head() {
        return {
            title: 'Malaysia Covid-19 Tracker',
            meta: [
                {
                    hid: 'description',
                    name: 'description',
                    content: 'Malaysia Covid-19 Tracker'
                }
            ]
        }
    },
    data() {
        return {
            allCases: [],
            allVacc: [],
        }
    },
    mounted() {
        console.log('Hello from the index page!')
        this.getCases()
        this.getVacc()
    },
    methods: {
        async getCases() {
            const response = await fetch('https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/cases_malaysia.csv')
            const data = await response.text()
            this.allCases = parseCsv(data)
            // console.log(parseCsv(data))
            console.warn(this.allCases[this.allCases.length - 2])
        },
        async getNews() {
            const url = "https://www.thestar.com.my/rss/News"
            const response = await fetch(url)
            const data = await response.text()
            console.log(data)
        },
        async getVacc() {
            const url = "https://raw.githubusercontent.com/CITF-Malaysia/citf-public/main/vaccination/vax_malaysia.csv"
            const response = await fetch(url)
            const data = await response.text()
            this.allVacc = parseCsv(data)
            console.log(this.allVacc)
        }
    }
}
</script>