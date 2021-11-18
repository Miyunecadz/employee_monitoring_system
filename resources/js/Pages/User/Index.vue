<template>
    <Head title="List of Users" />

    <BreezeAuthenticatedLayout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                    <div class="grid gap-2 md:flex">
                        <div class="md:mr-auto">
                            <form @submit.prevent="submit">
                                <div class="grid grid-rows-2 gap-2 md:flex">
                                    <Input id="keyword" type="text" class="mt-1 block sm:w-full md:w-10/12" v-model="form.keyword" autofocus autocomplete="username" placeholder="Keyword..." />
                                    <Button class="" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        <Icon >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                        </Icon>
                                        Filter
                                    </Button>
                                </div>
                            </form>
                        </div>

                        <Link :href="route('users.create')" class="bg-blue-700 hover:bg-blue-500 text-white font-bold py-3 text-sm px-3 rounded flex" >
                            <Icon>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                            </Icon>
                            New User
                        </Link>
                    </div>


                    <hr class="md:hidden my-2" />

                    <div class="flex flex-col mt-4">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Username
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Role
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <template v-if="users.data | users.data.length">
                                        <tr v-for="user in users.data" :key="user.id">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ user.firstname }} {{ user.lastname }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ user.username }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ user.email }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ user.role }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            </td>
                                        </tr>
                                    </template>
                                    <template v-else>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap" colspan="5">
                                                <div class=" items-center">
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900 text-center">
                                                            No Data Found
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        </div>
                    </div>

                        <div v-if="users.links">
                            <pagination :links="users.links"  class="pt-3"/>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import Pagination from '@/Components/Pagination.vue'
import { Head } from '@inertiajs/inertia-vue3';
import Input from '@/Components/Input.vue'
import Button from '@/Components/Button.vue'
import Link from '@/Components/Link.vue'
import Icon from '@/Components/Icon.vue'

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Pagination,
        Input,
        Button,
        Link,
        Icon
    },
    props: {
        users: Object,
        isFiltered: Boolean,
    },
    data(){
        return{
            form: this.$inertia.form({
                keyword: ''
            })
        }
    },
    methods: {
        submit() {
            this.form.get(this.route('users.filter', {keyword: this.keyword}))
        }
    }
}
</script>
