<template>
    <div class="search-section">
        <input type="search" class="input-text" name="search" id="">
        <hr class="config-line">
        <span class="config-text" @click="filter()">Config &blacktriangledown;</span>
        <div class="filters">
            <span class="title">type :</span>
            <br>
            <div id="type-filter">
                <a class="tag" @click="typed(0)">person</a>
                <a class="tag" @click="typed(1)">Ink</a>
                <a class="tag" @click="typed(2)">photo</a>
                <a class="tag" @click="typed(3)">video</a>
                <a class="tag" @click="typed(4)">hash tag</a>
            </div>
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
                type: [
                    false,
                    false,
                    false,
                    false,
                    false,
                ],
                dateArray: [
                    'today',
                    'this week',
                    'this month',
                    'this year',
                ]
            }
        },
        methods: {
            sendRequest: function () {
                //TODO :  axios.get
            },
            typed: function (index) {
                let meta = document.getElementById('type-filter');
                this.type[index] = !this.type[index];
                for (let i = 0; i < 5; i++) {
                    if (i == index) {
                        if (meta.children[index].className == 'tag') {
                            meta.children[index].className += ' active-tag';
                            meta.children[index].innerHTML = "&dash; " + meta.children[index].innerHTML;
                        } else {
                            meta.children[index].className = 'tag';
                            meta.children[index].innerHTML =
                                meta.children[index].innerHTML.slice(2, meta.children[index].innerHTML.length);
                        }
                    }
                }
                this.sendRequest();
            },
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
                this.sendRequest();
            }
        }
    }
</script>

<style scoped>

</style>