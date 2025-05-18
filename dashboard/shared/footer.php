<footer class="footer text-center">
        <p>&copy; 2025 Plant Shop Admin Panel</p>
        <p>Contact us: <a href="mailto:support@plantshop.com" class="text-white">support@plantshop.com</a> | Phone: +123 456 7890</p>
    </footer>
    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize all dropdowns
        document.addEventListener('DOMContentLoaded', function() {
            var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
            var dropdownList = dropdownElementList.map(function(element) {
                return new bootstrap.Dropdown(element);
            });
        });
    </script>
</body>
</html>
