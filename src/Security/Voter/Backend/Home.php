<?php
/*
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential.
 *
 * @owner        : Mazars SA - 61 rue Henri Régnault, 92400 Courbevoie
 * @organization : EAZY By Mazars
 * @contact      : christophe.ballihaut@mazars.fr
 *
 * Mazars SA (c) 2016-present
 *
 */

namespace App\Security\Voter;


use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class Home extends Voter
{
    const LIST = 'list';

    protected function supports($attribute, $subject): bool
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::LIST])) {
            return false;
        }
        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        // the user must be logged in; if not, deny access
        if (!$token->getUser() instanceof User) {
            return false;
        }
        switch ($attribute) {
            case self::LIST:
                return $this->canList();
        }
        throw new \Exception('This code should not be reached!');
    }

    private function canList(): bool
    {
        return true;
    }
}


