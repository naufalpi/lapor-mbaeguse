{{-- <div class="h-scree">
  <div class="pt-12 bg-gray-50  sm:pt-20">
    <div class="max-w-screen-xl px-4 mx-auto sm:px-6 lg:px-8">
      <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-3xl font-extrabold leading-9 text-gray-900  sm:text-4xl sm:leading-10">
          Trusted by developers
        </h2>
        <p class="mt-3 text-xl leading-7 text-gray-600  sm:mt-4">
          This package powers many production applications on many different hosting platforms.
        </p>
      </div>
    </div>
    <div class="pb-12 mt-10 bg-gray-50  sm:pb-16">
      <div class="relative">
        <div class="absolute inset-0 h-1/2 bg-gray-50 "></div>
        <div class="relative max-w-screen-xl px-4 mx-auto sm:px-6 lg:px-8">
          <div class="max-w-4xl mx-auto">
            <dl class="bg-white  rounded-lg shadow-lg sm:grid sm:grid-cols-3">
              <div
                class="flex flex-col p-6 text-center border-b border-gray-100  sm:border-0 sm:border-r">
                <dt class="order-2 mt-2 text-lg font-medium leading-6 text-gray-500 " id="item-1">
                  Stars on GitHub
                </dt>
                <dd class="order-1 text-5xl font-extrabold leading-none text-indigo-600 "
                  aria-describedby="item-1" id="starsCount">
                  0
                </dd>
              </div>
              <div
                class="flex flex-col p-6 text-center border-t border-b border-gray-100  sm:border-0 sm:border-l sm:border-r">
                <dt class="order-2 mt-2 text-lg font-medium leading-6 text-gray-500 ">
                  Downloads
                </dt>
                <dd class="order-1 text-5xl font-extrabold leading-none text-indigo-600 "
                  id="downloadsCount">
                  0
                </dd>
              </div>
              <div
                class="flex flex-col p-6 text-center border-t border-gray-100  sm:border-0 sm:border-l">
                <dt class="order-2 mt-2 text-lg font-medium leading-6 text-gray-500 ">
                  Sponsors
                </dt>
                <dd class="order-1 text-5xl font-extrabold leading-none text-indigo-600 "
                  id="sponsorsCount">
                  0
                </dd>
              </div>
            </dl>
          </div>
        </div>
      </div>
    </div>
  </div>


  
</div>

<script>
  const targets = [
    { element: document.getElementById('starsCount'), count: 4670, suffix: '+' },
    { element: document.getElementById('downloadsCount'), count: 80000, suffix: '+' },
    { element: document.getElementById('sponsorsCount'), count: 100, suffix: '+' }
  ];

  // Find the maximum count among all targets
  const maxCount = Math.max(...targets.map(target => target.count));

  // Function to animate count-up effect
  function animateCountUp(target, duration) {
    let currentCount = 0;
    const increment = Math.ceil(target.count / (duration / 10));

    const interval = setInterval(() => {
      currentCount += increment;
      if (currentCount >= target.count) {
        clearInterval(interval);
        currentCount = target.count;
        target.element.textContent = currentCount + target.suffix;
      } else {
        target.element.textContent = currentCount;
      }
    }, 10);
  }

  // Animate count-up for each target with adjusted duration
  targets.forEach(target => {
    animateCountUp(target, maxCount / 100); // Adjust duration based on max count
  });
</script> --}}


<!-- Features -->
<div class="max-w-[85rem] px-4 py-30 sm:px-6 lg:px-8 lg:py-30 mx-auto">
  <!-- Grid -->
  <div class="lg:grid lg:grid-cols-12 lg:gap-16 lg:items-center">
    <div class="lg:col-span-7">
      <!-- Grid -->
      <div class="grid grid-cols-12 gap-2 sm:gap-6 items-center lg:-translate-x-10">
        <div class="col-span-4">
          <img class="rounded-xl" src="https://images.unsplash.com/photo-1606868306217-dbf5046868d2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=920&q=80" alt="Features Image">
        </div>
        <!-- End Col -->

        <div class="col-span-3">
          <img class="rounded-xl" src="https://images.unsplash.com/photo-1605629921711-2f6b00c6bbf4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=920&q=80" alt="Features Image">
        </div>
        <!-- End Col -->

        <div class="col-span-5">
          <img class="rounded-xl" src="https://images.unsplash.com/photo-1600194992440-50b26e0a0309?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=920&q=80" alt="Features Image">
        </div>
        <!-- End Col -->
      </div>
      <!-- End Grid -->
    </div>
    <!-- End Col -->

    <div class="mt-5 sm:mt-10 lg:mt-0 lg:col-span-5">
      <div class="space-y-6 sm:space-y-8">
        <!-- Title -->
        <div class="space-y-2 md:space-y-4">
          <h2 class="font-bold text-3xl lg:text-4xl text-gray-800 ">
            Collaborative tools to design user experience
          </h2>
          <p class="text-gray-500 ">
            Use our tools to explore your ideas and make your vision come true. Then share your work easily.
          </p>
        </div>
        <!-- End Title -->

        <!-- List -->
        <ul class="space-y-2 sm:space-y-4">
          <li class="flex gap-x-3">
            <span class="mt-0.5 size-5 flex justify-center items-center rounded-full bg-blue-50 text-blue-600 ">
              <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            <div class="grow">
              <span class="text-sm sm:text-base text-gray-500 ">
                <span class="font-bold">Less routine</span> – more creativity
              </span>
            </div>
          </li>

          <li class="flex gap-x-3">
            <span class="mt-0.5 size-5 flex justify-center items-center rounded-full bg-blue-50 text-blue-600 ">
              <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            <div class="grow">
              <span class="text-sm sm:text-base text-gray-500 ">
                Hundreds of thousands saved
              </span>
            </div>
          </li>

          <li class="flex gap-x-3">
            <span class="mt-0.5 size-5 flex justify-center items-center rounded-full bg-blue-50 text-blue-600 ">
              <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            <div class="grow">
              <span class="text-sm sm:text-base text-gray-500 ">
                Scale budgets <span class="font-bold">efficiently</span>
              </span>
            </div>
          </li>
        </ul>
        <!-- End List -->
      </div>
    </div>
    <!-- End Col -->
  </div>
  <!-- End Grid -->
</div>
<!-- End Features -->