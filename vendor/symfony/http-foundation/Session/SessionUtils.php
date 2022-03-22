<?php


namespace Symfony\Component\HttpFoundation\Session;

/**
 * Session utility functions.
 *
 * @author Miloš Ćorlomanović <office.inint@gmail.com>
 * @author Rémon van de Kamp <rpkamp@gmail.com>
 *
 * @internal
 */
final class SessionUtils
{
    /**
     * Finds the session header amongst the headers that are to be sent, removes it, and returns
     * it so the caller can process it further.
     */
    public static function popSessionCookie(string $sessionName, string $sessionId): ?string
    {
        $sessionCookie = null;
        $sessionCookiePrefix = sprintf(' %s=', urlencode($sessionName));
        $sessionCookieWithId = sprintf('%s%s;', $sessionCookiePrefix, urlencode($sessionId));
        $otherCookies = [];
        foreach (headers_list() as $h) {
            if (0 !== stripos($h, 'Set-Cookie:')) {
                continue;
            }
            if (11 === strpos($h, $sessionCookiePrefix, 11)) {
                $sessionCookie = $h;

                if (11 !== strpos($h, $sessionCookieWithId, 11)) {
                    $otherCookies[] = $h;
                }
            } else {
                $otherCookies[] = $h;
            }
        }
        if (null === $sessionCookie) {
            return null;
        }

        header_remove('Set-Cookie');
        foreach ($otherCookies as $h) {
            header($h, false);
        }

        return $sessionCookie;
    }
}
