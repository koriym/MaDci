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

The trait's `__call` forwards to the roles bound to the object. A role lists its methods as closures, and each is bound to the Data object before it runs: `$this` inside a role method is the object itself, and the context the role was bound with comes in as `$context`.

```php
final class SourceAccountRole extends AbstractRole
{
    protected function methods(AbstractContext $context): array
    {
        return [
            'transfer' => function (int $amount) use ($context): void {
                $context->destinationAccount->deposit($amount);
                $this->decreaseBalance($amount);
            },
        ];
    }
}
```

The methods are closures rather than methods of the role class because PHP does not rebind a method's `$this` to an object of another class. The closure keeps the role's scope, so a role sees the object through its public interface: a private method of the Data class is as unreachable from a role as an unbound role method.

Against the checklist in [I found a library that claims to do DCI, how can I know that it does?](http://fulloo.info/doku.php?id=i_found_a_library_that_claims_to_do_dci_how_can_i_know_that_it_does):

- Object identity holds. Role methods reach the object through any reference, including `$this` inside the Data class's own methods.
- `$this` inside a role method is the object.
- Roles are bound at run time, per context, and go away with the context.
- Roles reach each other by role name through the context.
- Not DCI: while a context is alive, its role methods can be called from any reference to the object, not only from inside the context.

Two rules follow from dispatching through `__call`. A role may not declare a method the Data class already has, or one another role of the same context already provides; binding throws `RoleMethodCollision`. When two live contexts bind roles to one object, the context bound last answers first.

## Link

 * [DCI - Data Context Interaction](https://en.wikipedia.org/wiki/Data,_context_and_interaction)
 * [FullOO Home Page](http://fulloo.info/) 
 * [Alan Kay On Messaging](http://wiki.c2.com/?AlanKayOnMessaging)
 * [DCI in PHP](https://www.slideshare.net/HermanPeeren/dci-in-php)
 * [Why isn't it DCI if you use a wrapper object to represent the Role?](http://fulloo.info/doku.php?id=why_isn_t_it_dci_if_you_use_a_wrapper_object_to_represent_the_role)
 * [Beyond MVC (JA)](http://phpmentors.jp/post/69076928673/beyond-mvc)
