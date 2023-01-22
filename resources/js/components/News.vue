<template>
    <div class="news">
        <table>
            <tr>
                <th>Rank</th>
                <th>Title</th>
                <th>Link</th>
                <th>Points</th>
                <th>Date created</th>
            </tr>
            <tr @click="prepareDelete($event)" v-for="item in responseData" v-bind:id="item.post_id">
                <td>{{ item.post_id }}</td>
                <td>{{ item.title }}</td>
                <td>{{ item.link }}</td>
                <td>{{ item.points }}</td>
                <td>{{ item.post_created_at }}</td>
            </tr>
        </table>
        <button @click="prevNews()">Previous</button>
        <button @click="nextNews()">Next</button>
        <button @click="deleteItems()">Delete</button>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    data: function() {
    return {
            deleteItem: null,
            responseData: null,
            page: 0,
            pageSize: 10
        }
    },
    methods: {
        getNews(page, pageSize) {
            axios.post('api/items', {
                data: {
                    start: page * pageSize + 1,
                    limit: pageSize
                }
            })
            .then( response => {
                if (response.data.length) {
                    this.responseData = response.data
                }
            })
            .catch( error => {
                console.log(error)
            })
        },
        nextNews() {
            this.clearSelection()
            this.page = this.page * this.pageSize <= this.responseData.length ? this.page + 1 : this.page
            this.getNews(this.page, this.pageSize)
            this.deleteItemId = null
        },
        prevNews() {
            this.clearSelection()
            this.page = this.page > 0 ? this.page - 1 : 0 
            this.getNews(this.page, this.pageSize)
            this.deleteItemId = null
        },
        prepareDelete(event) {
            this.clearSelection()
            this.deleteItem = event.target.closest('tr')
            if (this.deleteItem.style.background == "red") {
                this.deleteItem.style.background = "white"
            } else {
                this.deleteItem.style.background = "red"
            }
        },
        clearSelection() {

            const boxes = document.querySelectorAll('tr');

            boxes.forEach(box => {
            box.style.backgroundColor = 'white';
            });
        },
        deleteItems() {
            this.clearSelection()
            axios.put('api/item/' + this.deleteItem.id)
            .then( response => {
                console.log(response)
            })
            .catch( error => {
                console.log(error)
            })
            this.getNews(this.page, this.pageSize)
        }
    },
    mounted() {
        this.getNews(this.page, this.pageSize)
    }
}
</script>

<style>
.news table {
    border-collapse: collapse;
}
.news td, th {
    border: 1px solid black;
}
</style>