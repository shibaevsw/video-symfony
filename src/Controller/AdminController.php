<?php

namespace App\Controller;

use App\Entity\Category;
use App\Utils\CategoryTreeAdminList;
use App\Utils\CategoryTreeAdminOptionList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin_main_page")
     */
    public function index()
    {
        return $this->render('admin/my_profile.html.twig');
    }

    /**
     * @Route("/categories", name="categories")
     */
    public function categories(CategoryTreeAdminList $categories)
    {
        $categories->getCategoryList($categories->buildTree());
        return $this->render('admin/categories.html.twig', [
            'categories' => $categories->categorylist
        ]);
    }

    /**
     * @Route("/videos", name="videos")
     */
    public function videos()
    {
        return $this->render('admin/videos.html.twig');
    }

    /**
     * @Route("/upload_video", name="upload_video")
     */
    public function uploadVideo()
    {
        return $this->render('admin/upload_video.html.twig');
    }

    /**
     * @Route("/users", name="users")
     */
    public function users()
    {
        return $this->render('admin/users.html.twig');
    }

    /**
     * @Route("/edit_category", name="edit_category")
     */
    public function editCategory()
    {
        return $this->render('admin/edit_category.html.twig');
    }

    /**
     * @Route("/delete_category/{id}", name="delete_category")
     */
    public function deleteCategory(Category $category)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($category);
        $entityManager->flush();
        return $this->redirectToRoute('categories');
    }

    public function getAllCategories(CategoryTreeAdminOptionList $categories)
    {
        $categories->getCategoryList($categories->buildTree());
        return $this->render('admin/_all_categories.html.twig', [
            'categories' => $categories
        ]);
    }
}
