![Laravel tests](https://github.com/amitavroy/cronos/actions/workflows/laravel.yml/badge.svg)

# CRONOs application

![CRONOs Dashboard](https://ik.imagekit.io/xqpqzbbjz/cronos/cronos_dashboard_3.jpg?updatedAt=1735098259405)

Base theme taken from [Flowbite admin](https://github.com/themesberg/flowbite-admin-dashboard/tree/main)

Currently, these are the features that are almost working:

- Users
    - Users can sign in to the application
    - The development username and password is automatically picked if configured in `.env`
    - Listing of user as part of the CRUD is available
    - User can be added, edited and deleted
    - A user can go to the Profile page and change profile detail
    - A user can also upload his/her profile picture
    - A user can also change his/her password from the profile page
    - There are currently three roles in the app - Customer, Manager and Admin
- Products
    - This is part of the commerce features
    - Listing of products is visible
    - Products can be added, edited and deleted
- Orders
    - Right now the orders are system generated
    - Listing of Orders along with Order items is visible
    - A `CRON` runs every minute to add a random number of orders
- Notifications
    - An Admin can create a notification which will go to everyone
    - An Admin can create a notification and send to specific users only
    - Users can click on the Notificatoin bell icon to see all notifications
