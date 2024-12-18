<x-app-layout :title="$title" :desc="$desc">
  <div class="ml-60 mt-4 overflow-x-auto p-2 bg-gray-100 border border-gray-200 shadow-md shadow-black/10 rounded-md">
      <div class="p-0">
          <ul role="list" class="divide-y divide-gray-300 px-3">
              @forelse ($notifications as $notification)
                  <li x-data="{ open: false }" class="bg-gray-100 hover:bg-gray-200 p-3 my-1.5 rounded-lg shadow-lg shadow-black/15">
                      <div class="flex justify-between items-center" @click="open = !open">
                          <div class="flex min-w-0 ml-3">
                              <div class="min-w-0 flex-auto">
                                  <p class="text-xl font-bold text-gray-900">{{ $notification->title }}</p>
                              </div>
                          </div>
                          <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                              <p class="text-sm/6 text-gray-900">{{ $notification->input_dept }}</p>
                              <p class="mt-1 text-xs/5 text-gray-500">{{ Carbon\Carbon::parse($notification->created_at)->format('d M Y ') }} / {{ Carbon\Carbon::parse($notification->created_at)->format('H:i') }}</p>
                          </div>
                      </div>
                      <div x-show="open" x-transition class="ml-3">
                          <p class="text-sm text-gray-700">{{ $notification->content }}</p>
                      </div>
                  </li>
              @empty
                  <li class="flex justify-between bg-gray-100 hover:bg-gray-300 p-3 my-2 rounded-lg shadow-lg shadow-black/15">
                      <div class="min-w-0 flex-auto">
                          <p class="text-lg/2 font-bold text-gray-900">No Notification Found</p>
                      </div>
                  </li>
              @endforelse
          </ul>
      </div>

      <div class="mx-3 shadow-lg shadow-black/15 mb-2">
          <div class="flex w-full items-center justify-between border-t border-gray-200 bg-white px-10 py-3 rounded-md">
              <div class="flex flex-1 justify-between sm:hidden">
                  {{ $notifications->links() }}
              </div>
              <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                  <div>
                      <p class="text-sm text-gray-700">
                          Showing
                          <span class="font-medium">{{ $notifications->firstItem() }}</span>
                          to
                          <span class="font-medium">{{ $notifications->lastItem() }}</span>
                          of
                          <span class="font-medium">{{ $notifications->total() }}</span>
                          results
                      </p>
                  </div>
                  <div>
                    <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                      @if ($notifications->onFirstPage())
                          <span class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 cursor-default">
                              <span class="sr-only">Previous</span>
                              <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                  <path fill-rule="evenodd" d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                              </svg>
                          </span>
                      @else
                          <a href="{{ $notifications->previousPageUrl() }}" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                              <span class="sr-only">Previous</span>
                              <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                  <path fill-rule="evenodd" d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                              </svg>
                          </a>
                      @endif
  
                      @foreach ($notifications->links()->elements as $element)
                          @if (is_string($element))
                              <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 cursor-default">{{ $element }}</span>
                          @endif
  
                          @if (is_array($element))
                              @foreach ($element as $page => $url)
                                  @if ($page == $notifications->currentPage())
                                      <span aria-current="page" class="relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ $page }}</span>
                                  @else
                                      <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">{{ $page }}</a>
                                  @endif
                              @endforeach
                          @endif
                      @endforeach
  
                      @if ($notifications->hasMorePages())
                          <a href="{{ $notifications->nextPageUrl() }}" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                              <span class="sr-only">Next</span>
                              <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                  <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                              </svg>
                          </a>
                      @else
                          <span class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 cursor-default">
                              <span class="sr-only">Next</span>
                              <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                  <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                              </svg>
                          </span>
                      @endif
                  </nav>
                  </div>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>