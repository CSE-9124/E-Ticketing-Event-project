<footer class="bg-gray-900 text-gray-300">
    <!-- Main Footer Content -->
    <div class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:py-16 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div>
                <h3 class="text-xl font-bold text-white mb-4">TixFest</h3>
                <p class="text-sm text-gray-400 mb-4">Your trusted platform for discovering and booking amazing events. Experience unforgettable moments with us.</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-yellow-400 transition-colors">
                        <ion-icon name="logo-facebook" class="text-xl"></ion-icon>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-yellow-400 transition-colors">
                        <ion-icon name="logo-twitter" class="text-xl"></ion-icon>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-yellow-400 transition-colors">
                        <ion-icon name="logo-instagram" class="text-xl"></ion-icon>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-yellow-400 transition-colors">
                        <ion-icon name="logo-linkedin" class="text-xl"></ion-icon>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('events') }}" class="text-gray-400 hover:text-yellow-400 transition-colors">Browse Events</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition-colors">How It Works</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition-colors">Pricing</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition-colors">FAQs</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Contact Us</h3>
                <ul class="space-y-2">
                    <li class="flex items-center">
                        <ion-icon name="location-outline" class="text-yellow-400 mr-2"></ion-icon>
                        <span class="text-gray-400">Indonesia, Makassar</span>
                    </li>
                    <li class="flex items-center">
                        <ion-icon name="call-outline" class="text-yellow-400 mr-2"></ion-icon>
                        <span class="text-gray-400">+62 811-410-610</span>
                    </li>
                    <li class="flex items-center">
                        <ion-icon name="mail-outline" class="text-yellow-400 mr-2"></ion-icon>
                        <span class="text-gray-400">info@tixfest.com</span>
                    </li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Newsletter</h3>
                <p class="text-sm text-gray-400 mb-4">Subscribe to our newsletter for updates and exclusive offers.</p>
                <form class="flex flex-col space-y-2">
                    <input type="email" placeholder="Your email address" 
                        class="bg-gray-800 text-white px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    <button type="submit" 
                        class="bg-yellow-400 text-gray-900 px-4 py-2 rounded-lg hover:bg-yellow-500 transition-colors">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-400">
                <div class="mb-2 md:mb-0">
                    &copy; {{ date('Y') }} TixFest. All rights reserved.
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="hover:text-yellow-400 transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-yellow-400 transition-colors">Terms of Service</a>
                    <a href="#" class="hover:text-yellow-400 transition-colors">Cookie Policy</a>
                </div>
            </div>
        </div>
    </div>
</footer>
