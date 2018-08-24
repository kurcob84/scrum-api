<?php

namespace App\Http\Middleware;


class CheckForRole extends \Tymon\JWTAuth\Http\Middleware\BaseMiddleware
{        
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next, $role="")
    {        
        try 
        {
            $token = $this->auth->setRequest($request)->parseToken('bearer', 'authorization')->getToken();
            $user = $this->auth->authenticate($token);
        } 
        catch (JWTException $e) 
        {
           return response('mwm.jwt.token_not_provided', 'token_not_provided', 401);
        }
        catch ( \Tymon\JWTAuth\Exceptions\TokenExpiredException $e) 
        {
            return response()->json(['error'=>'token_expired'], 401);
        } 
        catch ( \Tymon\JWTAuth\Exceptions\JWTException $e) 
        {
            return response()->json(['error'=>'token_invalid'], 401);
        }       
        
        if (!$user)
        {
            return response()->json(['error'=>'user_not_found'], 401);
        }
        
        // check roles of user, if set
        if($role !== "")
        {            
            $found = false;
            
            // get roles of user
            $roles = $user->roles()->get()->toArray();  
            foreach($roles as $r)
            {
                if($r['name'] === $role)
                {
                    $found = true;
                }
            }
            if(!$found)
            {
                return response()->json(['error'=>'insufficent_rights'], 401);
            }            
        }
        
        return $next($request);
    }
}
