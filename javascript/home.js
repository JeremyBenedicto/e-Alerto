function showTab(tabId) {
    // Hide all tab contents
    var tabContents = document.querySelectorAll('.tab-content');
    tabContents.forEach(function(tabContent) {
      tabContent.classList.remove('active');
    });
  
    // Show the selected tab content
    var selectedTabContent = document.getElementById(tabId);
    selectedTabContent.classList.add('active');
  }
  