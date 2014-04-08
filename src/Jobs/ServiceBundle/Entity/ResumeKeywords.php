<?php

namespace Jobs\ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ResumeKeywords
 */
class ResumeKeywords
{
    /**
     * @var string
     */
    private $resumeId;

    /**
     * @var string
     */
    private $keyword;


    /**
     * Set resumeId
     *
     * @param string $resumeId
     * @return ResumeKeywords
     */
    public function setResumeId($resumeId)
    {
        $this->resumeId = $resumeId;
    
        return $this;
    }

    /**
     * Get resumeId
     *
     * @return string 
     */
    public function getResumeId()
    {
        return $this->resumeId;
    }

    /**
     * Set keyword
     *
     * @param string $keyword
     * @return ResumeKeywords
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;
    
        return $this;
    }

    /**
     * Get keyword
     *
     * @return string 
     */
    public function getKeyword()
    {
        return $this->keyword;
    }
}