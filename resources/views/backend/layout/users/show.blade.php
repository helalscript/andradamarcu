<div class="max-w-3xl mx-auto bg-white shadow-2xl rounded-lg overflow-hidden p-8 space-y-6">
    <!-- Contractor Info Section -->
    <div class="text-center">
        <h2 class="text-3xl font-semibold text-gray-800 mb-2">User Profile</h2>
        <p class="text-lg text-gray-500">Profile Information</p>
    </div>

    <!-- Status and Selfie Section -->
    <div class="flex items-center justify-between space-x-6 bg-gray-50 p-4 rounded-lg shadow-md">
        <div
            class="flex items-center space-x-6 p-4 bg-gray-50 rounded-lg hover:shadow-xl transition duration-300 ease-in-out">
            <!-- Category Title -->
            <span class="text-gray-600 font-medium text-lg hover:text-gray-800 transition duration-200">
                {{-- {{ $data->category->title }} --}}
            </span>

            <!-- Status Badge -->
            <span
                class="px-4 py-2 text-sm font-semibold rounded-full 
                        {{ $data->status == 'pending' ? 'bg-yellow-300 text-yellow-800' : 'bg-green-300 text-green-800' }} 
                        transition duration-300 ease-in-out hover:scale-105 cursor-pointer">
                {{ ucfirst($data->status) }}
            </span>
        </div>


        <div class="flex-shrink-0 relative group">
            <!-- Selfie Photo with Hover Effect -->
            <img src="{{ asset($data->avatar) }}" alt="Selfie Photo"
                class="w-32 h-32 object-cover rounded-full border-4 border-gray-200 shadow-lg transition duration-300 ease-in-out hover:scale-105">

            <!-- Eye Icon on Hover -->
            <a href="{{ asset($data->avatar) }}" target="_blank"
                class="absolute inset-0 flex justify-center items-center opacity-0 group-hover:opacity-100 transition duration-300 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-800 hover:text-gray-600" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12c0 2.21-1.79 4-4 4s-4-1.79-4-4 1.79-4 4-4 4 1.79 4 4z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.938 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.47 7-9.542 7s-8.268-2.943-9.542-7z" />
                </svg>
            </a>
        </div>
    </div>

    <!-- User Info Section -->
    <div class="bg-gray-50 p-4 rounded-lg shadow-md space-y-4">
        <h3 class="text-2xl font-semibold text-gray-800">Contractor Info</h3>
        <div class="space-y-2">
            <div class="flex justify-between items-center">
                <span class="text-gray-500 font-medium">Name:</span>
                <span class="text-gray-700">{{ $data->name }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-gray-500 font-medium">Email:</span>
                <span class="text-gray-700">{{ $data->email }}</span>
            </div>
        </div>
    </div>
    <!-- User Info Section -->
    <div class="bg-gray-50 p-4 rounded-lg shadow-md space-y-4">
        <h3 class="text-2xl font-semibold text-gray-800">Job Post</h3>
        <div class="space-y-2">
            <div class="flex justify-between items-center">
                <span class="text-gray-500 font-medium">Total Job Post:</span>
                <span class="text-gray-700">{{ $data->jobPosts->count() }}</span>
            </div>
        </div>
        <div class="space-y-2">
            <div class="flex justify-between items-center">
                <span class="text-gray-500 font-medium">Completed Job:</span>
                <span class="text-gray-700">
                    {{ $data->jobPosts->filter(function ($jobPost) {
                            return $jobPost->status === 'completed';
                        })->count() }}</span>
            </div>
        </div>
        <div class="space-y-2">
            <div class="flex justify-between items-center">
                <span class="text-gray-500 font-medium">Canceled Job:</span>
                <span class="text-gray-700">
                    {{ $data->jobPosts->filter(function ($jobPost) {
                            return $jobPost->status === 'canceled';
                        })->count() }}</span>
            </div>
        </div>
        <div class="space-y-2">
            <div class="flex justify-between items-center">
                <span class="text-gray-500 font-medium">Confirmed Job:</span>
                <span class="text-gray-700">
                    {{ $data->jobPosts->filter(function ($jobPost) {
                            return $jobPost->status === 'confirmed';
                        })->count() }}</span>
            </div>
        </div>
        <div class="space-y-2">
            <div class="flex justify-between items-center">
                <span class="text-gray-500 font-medium">Pending Job:</span>
                <span class="text-gray-700">
                    {{ $data->jobPosts->filter(function ($jobPost) {
                            return $jobPost->status === 'pending';
                        })->count() }}</span>
            </div>
        </div>
        <div class="space-y-2">
            <div class="flex justify-between items-center">
                <span class="text-gray-500 font-medium">Available Job:</span>
                <span class="text-gray-700">
                    {{ $data->jobPosts->filter(function ($jobPost) {
                            return $jobPost->status === 'available';
                        })->count() }}</span>
            </div>
        </div>
    </div>

    <!-- Additional Info -->
    <div class="space-y-2 shadow-md">
        <div class="flex justify-between">
            <span class="text-gray-500">Joined At:</span>
            <span class="text-gray-700">{{ \Carbon\Carbon::parse($data->created_at)->format('d-M-Y h:i A') }}</span>
        </div>
    </div>
</div>
