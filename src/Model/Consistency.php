<?php

namespace Chiphpotle\Rest\Model;

/**
 * Consistency will define how a request is handled by the backend.
 * By defining a consistency requirement, and a token at which those
 * requirements should be applied, where applicable.
 */
final class Consistency
{
    public function __construct(
        private ?ZedToken $atExactSnapshot = null,
        private ?ZedToken $atLeastAsFresh = null,
        /**
         * minimize_latency indicates that the latency for the call should be
         * minimized by having the system select the fastest snapshot available.
         */
        private ?bool             $minimizeLatency = null,
        /**
         * fully_consistent indicates that all data used in the API call *must* be
         * at the most recent snapshot found.
         *
         * NOTE: using this method can be *quite slow*, so unless there is a need to
         * do so, it is recommended to use `at_least_as_fresh` with a stored
         * ZedToken.
         */
        protected ?bool             $fullyConsistent = null
    ) {
    }

    public static function minimizeLatency(): Consistency
    {
        return new self(null, null, true);
    }

    public static function fullyConsistent(): Consistency
    {
        return new self(null, null, null, true);
    }

    public static function atExactSnapshot(ZedToken|string $token): Consistency
    {
        if ($token instanceof ZedToken) {
            return new self($token);
        }
        return new self(new ZedToken($token));
    }

    public static function atLeastAsFresh(ZedToken|string $token): Consistency
    {
        if ($token instanceof ZedToken) {
            return new self(null, $token);
        }
        return new self(null, ZedToken::create($token));
    }

    public function getMinimizeLatency(): ?bool
    {
        return $this->minimizeLatency;
    }

    public function setMinimizeLatency(?bool $minimizeLatency): self
    {
        $this->minimizeLatency = $minimizeLatency;
        return $this;
    }

    public function getAtLeastAsFresh(): ?ZedToken
    {
        return $this->atLeastAsFresh;
    }

    public function setAtLeastAsFresh(?ZedToken $atLeastAsFresh): self
    {
        $this->atLeastAsFresh = $atLeastAsFresh;
        return $this;
    }

    public function getAtExactSnapshot(): ?ZedToken
    {
        return $this->atExactSnapshot;
    }

    public function setAtExactSnapshot(?ZedToken $atExactSnapshot): self
    {
        $this->atExactSnapshot = $atExactSnapshot;
        return $this;
    }

    public function getFullyConsistent(): ?bool
    {
        return $this->fullyConsistent;
    }

    public function setFullyConsistent(?bool $fullyConsistent): self
    {
        $this->fullyConsistent = $fullyConsistent;
        return $this;
    }
}
