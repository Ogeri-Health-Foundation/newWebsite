function getDummyBlogs(page = 1, perPage = 5) {
  const blogs = [
    { id: 1, title: "Blog Post 1", category: "Category 1", created_at: "2024-03-01", published_at: "2024-03-02", status: "Published" },
    { id: 2, title: "Blog Post 2", category: "Category 2", created_at: "2024-03-02", published_at: null, status: "Draft" },
    { id: 3, title: "Blog Post 3", category: "Category 3", created_at: "2024-03-03", published_at: "2024-03-04", status: "Published" },
    { id: 4, title: "Blog Post 4", category: "Category 1", created_at: "2024-03-04", published_at: null, status: "Draft" },
    { id: 5, title: "Blog Post 5", category: "Category 2", created_at: "2024-03-05", published_at: "2024-03-06", status: "Published" },
    { id: 6, title: "Blog Post 6", category: "Category 3", created_at: "2024-03-06", published_at: null, status: "Draft" },
    { id: 7, title: "Blog Post 7", category: "Category 1", created_at: "2024-03-07", published_at: "2024-03-08", status: "Published" },
    { id: 8, title: "Blog Post 8", category: "Category 2", created_at: "2024-03-08", published_at: null, status: "Draft" },
    { id: 9, title: "Blog Post 9", category: "Category 3", created_at: "2024-03-09", published_at: "2024-03-10", status: "Published" },
    { id: 10, title: "Blog Post 10", category: "Category 1", created_at: "2024-03-10", published_at: null, status: "Draft" },
    { id: 11, title: "Blog Post 11", category: "Category 2", created_at: "2024-03-11", published_at: "2024-03-12", status: "Published" },
    { id: 12, title: "Blog Post 12", category: "Category 3", created_at: "2024-03-12", published_at: null, status: "Draft" },
    { id: 13, title: "Blog Post 13", category: "Category 1", created_at: "2024-03-13", published_at: "2024-03-14", status: "Published" },
    { id: 14, title: "Blog Post 14", category: "Category 2", created_at: "2024-03-14", published_at: null, status: "Draft" },
    { id: 15, title: "Blog Post 15", category: "Category 3", created_at: "2024-03-15", published_at: "2024-03-16", status: "Published" }
  ];

  const totalBlogs = blogs.length;
  const lastPage = Math.ceil(totalBlogs / perPage);
  const startIndex = (page - 1) * perPage;
  const paginatedBlogs = blogs.slice(startIndex, startIndex + perPage);

  return {
    data: paginatedBlogs,
    current_page: page,
    last_page: lastPage
  };
}

// Simulating API call
console.log(getDummyBlogs(1, 5)); // Fetch page 1
console.log(getDummyBlogs(2, 5)); // Fetch page 2
console.log(getDummyBlogs(3, 5)); // Fetch page 3
