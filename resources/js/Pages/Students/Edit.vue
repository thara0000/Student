<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head,Link,useForm  } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
const props  = defineProps({
    student:Object,
    image : String,
    errors: Object,
});

const form = useForm({
      name: props.student.name,
      image: null,
      age: props.student.age,
      status: props.student.status,
    })

    function UpdateStudent() {
        Inertia.post(`/student/${props.student.id}`, {
  _method: 'put',
      name: form.name,
      image: form.image,
      age: form.age,
      status: form.status,
})
    }
</script>

<template>
    <Head title="Students" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Student Edit
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex  m-2 p-2">
                <Link href="/students" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-6 text-white rounded">Back</Link>
            </div>
               <div class="flex flex-col">
                    <div class="grid place-content-center mt-10">
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <form  @submit.prevent="UpdateStudent" class="bg-white shadow-md m-2 p-2 rounded">
                                <div class="sm:col-span-6">
                                    <label for="name" class="block text-sm font-medium text-gray-700"> Name </label>
                                    <div class="mt-1">
                                        <input type="text" v-model="form.name" id="name" wire:model.lazy="name" name="name" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                    <div style="color:red" v-if="errors.name">{{ errors.name }}</div>
                                </div>
                                <div class="sm:col-span-6">
                                    <label for="age" class="block text-sm font-medium text-gray-700"> Age </label>
                                    <div class="mt-1">
                                        <input type="text" v-model="form.age" id="age" wire:model.lazy="age" name="age" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                    <div style="color:red" v-if="errors.age">{{ errors.age }}</div>
                                </div>
                                <div class="sm:col-span-6">
                                    <label for="status" class="block text-sm font-medium text-gray-700"> Status </label>
                                    <div class="mt-1">
                                        <select id="status" v-model="form.status" wire:model.lazy="status" name="status" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                            <option>Active</option>
                                            <option>Inactive</option>
                                        </select>
                                        <!-- <input type="text" id="title" wire:model.lazy="title" name="title" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" /> -->
                                    </div>
                                    <div style="color:red" v-if="errors.status">{{ errors.status }}</div>
                                </div>
                                
                                <div class="sm:col-span-6">
                                    <label for="imageprev" class="block text-sm font-medium text-gray-700">  </label>
                                    <div class="mt-1">
                                       <img :src="image" id="imageprev" name="imageprev" class="w-32 h-32"/>
                                    </div>
                                </div>
                                <div class="sm:col-span-6">
                                    <label for="title" class="block text-sm font-medium text-gray-700"> Image </label>
                                    <div class="mt-1">
                                        <input type="file" id="image" 
                                        @input="form.image = $event.target.files[0]" 
                                        wire:model="newImage" name="image" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                </div>
                                <div class="m-2 p-2">
                                    <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-green-600 rounded-lg text-white">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
