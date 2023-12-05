<template></template>

<script lang="ts">
import { parseCsv } from '../composables/parseCsv'

export default {
    data() {
        return {
            allCases: {}
        }
    },
    mounted() {
        console.log('Hello from the index page!')
        this.getCases()
    },
    methods: {
        async getCases() {
            const response = await fetch('https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/cases_malaysia.csv')
            const data = await response.text()
            this.allCases = parseCsv(data)
            console.log(parseCsv(data))
            console.warn(this.allCases[this.allCases.length - 2])
        }
    }
}
</script>