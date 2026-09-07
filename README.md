# Ma DCI

[<img width="640" height="427" alt="Image" src="https://github.com/user-attachments/assets/ec7884ac-b378-45ad-a1a0-28ed2c63438d" />](http://folk.uio.no/trygver/assets/Context-Orientation-2017-05-14%20T%2017-31-19.mp4)

> The Japanese have a small word - ma - for "that which
 is in between" - perhaps the nearest English equivalent is "interstitial".
 The key in making great and growable systems is much more to design how its
 modules communicate rather than what their internal properties and
 behaviors should be.
> 
> — Alan Kay

## Run Demo

```bash
composer install
php example/run.php
```

## Object Identity

This library is made for testing purposes.

`RoleInjector::inject()` returns the Data object it was given. There is no wrapper: the object that plays a role is the object you already hold, so `===`, `instanceof` and type declarations keep working, and every reference to it answers the role methods while the context that bound them is alive.

A Data class opts in with one line:

```php
final class Account
{
    use RolePlayer;
}
```

The trait's `__call` forwards to the roles bound to the object. Inside a role, `$this->context()` is the context that bound it, `$this->data` is the Data object when it has to be passed on, and a call the role does not define forwards to the Data object.

Against the checklist in [I found a library that claims to do DCI, how can I know that it does?](http://fulloo.info/doku.php?id=i_found_a_library_that_claims_to_do_dci_how_can_i_know_that_it_does):

- Object identity holds. Role methods reach the object through any reference, including `$this` inside the Data class's own methods.
- Roles are bound at run time, per context, and go away with the context.
- Roles reach each other by role name through the context.
- Not DCI: `$this` inside a role class is the role instance, not the object.
- Not DCI: while a context is alive, its role methods can be called from any reference to the object, not only from inside the context.

Two rules follow from dispatching through `__call`. A role may not declare a method the Data class already has, or one another role of the same context already provides; binding throws `RoleMethodCollision`. When two live contexts bind roles to one object, the context bound last answers first.

## Link

 * [DCI - Data Context Interaction](https://en.wikipedia.org/wiki/Data,_context_and_interaction)
 * [FullOO Home Page](http://fulloo.info/) 
 * [Alan Kay On Messaging](http://wiki.c2.com/?AlanKayOnMessaging)
 * [DCI in PHP](https://www.slideshare.net/HermanPeeren/dci-in-php)
 * [Why isn't it DCI if you use a wrapper object to represent the Role?](http://fulloo.info/doku.php?id=why_isn_t_it_dci_if_you_use_a_wrapper_object_to_represent_the_role)
 * [Beyond MVC (JA)](http://phpmentors.jp/post/69076928673/beyond-mvc)
