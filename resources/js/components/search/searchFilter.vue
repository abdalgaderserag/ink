<template>
    <div class="search-section">
        <input type="search" class="input-text" name="search" id="">
        <hr class="config-line">
        <span class="config-text" @click="filter()">Config &blacktriangledown;</span>
        <div class="filters">
            <span class="title">type :</span>
            <br>
            <a class="tag">person</a> <a class="tag">Ink</a><a class="tag">photo</a><a class="tag">video</a><a
                class="tag">hash tag</a>
            <br><br>
            <span class="title">time :</span>
            <br>
            <div id="date-filter">
                <a v-for="(dateItem,index) in dateArray" class="tag"
                   @click="dateEvent(index)">{{ dateItem }}</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "searchFilter",
        data() {
            return {
                showFilter: true,
                date: 'all',
                dateArray: [
                    'today',
                    'this week',
                    'this month',
                    'this year',
                ]
            }
        },
        methods: {
            filter: function () {
                this.showFilter = !this.showFilter;
                if (this.showFilter) {
                    document.getElementsByClassName('filters')[0].style.display = "none"
                } else {
                    document.getElementsByClassName('filters')[0].style.display = "block"
                }
            },
            dateEvent: function (index) {
                let meta;
                for (let i = 0; i < this.dateArray.length; i++) {
                    if (i == index) {
                        meta = document.getElementById('date-filter').children[i];
                        this.date = this.dateArray[index];
                        if (meta.className == 'tag') {
                            meta.innerHTML = "&dash; " + meta.innerHTML;
                            meta.className += ' active-tag';
                        } else {
                            meta.innerHTML = this.dateArray[index];
                            meta.className = 'tag'
                            this.date = 'all'
                        }
                    } else {
                        this.date = this.dateArray[index];
                        meta = document.getElementById('date-filter').children[i];
                        meta.innerHTML = this.dateArray[i];
                        meta.className = 'tag';
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>